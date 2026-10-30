# Email-limits

一个适用于 [Flarum](https://flarum.org) 2.0.x 的扩展插件，仅允许用户使用指定白名单域名内的邮箱地址进行注册。已经存在的账号不受任何影响，修改白名单也不会影响现有账号。

## 功能特性

- 在后台管理面板中添加 Email-limits 设置页面。

- 支持填写任意数量的允许邮箱后缀，按行分隔或用逗号隔开，例如 `qq.com`, `163.com`, `gmail.com`。

- 阻止使用其他邮箱域名的注册行为，并在错误提示中展示允许的邮箱后缀列表。

- 允许主域名的子域名注册（例如设置 `example.com`，则 `sub.example.com` 也会被接受）。

- 将列表留空即可禁用该限制，避免因意外配置锁定注册。

- 仅作用于新注册用户。现有用户绝不会被拦截或修改。


## 安装指南

使用 Composer 安装：

```bash
composer require tacraft-sociality/flarum-email-limits
```

## 更新

```bash
composer update tacraft-sociality/flarum-email-limits
php flarum cache:clear
```

## 卸载

```bash
composer remove tacraft-sociality/flarum-email-limits
```

## 相关链接

- [Packagist](https://packagist.org/packages/tacraft-sociality/flarum-email-limits)


## 开源协议

MIT