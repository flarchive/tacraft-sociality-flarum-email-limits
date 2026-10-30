import Extend from 'flarum/common/extenders';
import app from 'flarum/admin/app';

export const extend = [
  new Extend.Admin().setting(() => ({
    setting: 'tacraft-sociality-email-limits.suffixes',
    type: 'textarea',
    label: app.translator.trans('tacraft-sociality-email-limits.admin.settings.suffixes_label'),
    help: app.translator.trans('tacraft-sociality-email-limits.admin.settings.suffixes_help'),
    placeholder: 'qq.com\n163.com\ngmail.com',
  })),
];
