# HumHub Email Template Editor Plugin

Version: 1.0.0  
Compatible with: HumHub 1.17.x

## Description

This plugin allows administrators to customize email templates directly from the HumHub admin interface without modifying core files.

## Features

- ✉️ Edit all system email templates
- 🎨 Live preview of email changes
- 🔄 Reset templates to defaults
- 💾 Version history tracking
- 🌍 Multi-language support

## Installation

1. Download the plugin files
2. Extract to `protected/modules/emailtemplates/`
3. Run migration: `php yii migrate/up --migrationPath=@humhub/modules/emailtemplates/migrations`
4. Enable the module in Administration → Modules
5. Configure templates in Administration → Settings → Email Templates

## Usage

Navigate to **Administration → Settings → Email Templates** to:
- Select a template to edit
- Modify the subject and body
- Use available placeholders (e.g., {displayName}, {contentTitle})
- Preview your changes
- Save or reset to defaults

## Requirements

- HumHub 1.17.x
- PHP 7.4 or higher

## File Structure

```
protected/modules/emailtemplates/
├── Module.php
├── Events.php
├── config.php
├── module.json
├── controllers/
│   └── AdminController.php
├── models/
│   └── EmailTemplate.php
├── migrations/
│   └── m000000_000000_initial.php
├── views/
│   └── admin/
│       ├── index.php
│       ├── edit.php
│       └── preview.php
└── messages/
    └── en/
        └── base.php
```

## Changelog

### Version 1.0.0 (Initial Release)
- Basic email template editing functionality
- Template selection interface
- Placeholder support
- Reset to defaults feature
- Database migration for template storage
- Admin menu integration
- Preview functionality