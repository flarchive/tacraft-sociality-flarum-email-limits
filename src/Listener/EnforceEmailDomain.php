<?php

namespace TacraftSociality\EmailLimits\Listener;

use Flarum\Foundation\ValidationException;
use Flarum\Locale\TranslatorInterface;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\Event\Saving;

class EnforceEmailDomain
{
    public function __construct(
        protected SettingsRepositoryInterface $settings,
        protected TranslatorInterface $translator
    ) {
    }

    public function handle(Saving $event): void
    {
        $user = $event->user;

        $email = $event->data['attributes']['email'] ?? null;

        if ($user->exists) {
            if ($email === null) {
                return;
            }

            if (strcasecmp(trim((string) $email), trim((string) $user->getOriginal('email'))) === 0) {
                return;
            }
        } else {
            $email = $email ?? $user->email;
        }

        $suffixes = $this->allowedSuffixes();

        if ($suffixes === []) {
            return;
        }

        $domain = $this->domainOf((string) $email);

        foreach ($suffixes as $suffix) {
            if ($domain === $suffix || str_ends_with($domain, '.'.$suffix)) {
                return;
            }
        }

        throw new ValidationException([
            'email' => $this->translator->trans('tacraft-sociality-email-limits.api.invalid_email_domain', [
                'suffixes' => implode(', ', $suffixes),
            ]),
        ]);
    }

    protected function allowedSuffixes(): array
    {
        $raw = (string) $this->settings->get('tacraft-sociality-email-limits.suffixes');

        $suffixes = preg_split('/[\s,;]+/u', $raw) ?: [];

        $suffixes = array_map(function (string $suffix): string {
            $suffix = strtolower(trim($suffix));
            $suffix = ltrim($suffix, '@');

            if (str_starts_with($suffix, '*.')) {
                $suffix = substr($suffix, 2);
            }

            return trim($suffix, '.');
        }, $suffixes);

        return array_values(array_unique(array_filter($suffixes)));
    }

    protected function domainOf(string $email): string
    {
        $email = strtolower(trim($email));
        $at = strrpos($email, '@');

        if ($at === false) {
            return '';
        }

        return trim(substr($email, $at + 1), '.');
    }
}
