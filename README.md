# HumHub Email Template Editor Plugin

Version: 1.0.0  
Compatible with: HumHub 1.17.x

## Description

This plugin allows administrators to customize email templates directly from the HumHub admin interface without modifying core files.

## Features

- ✉️ Edit all system email templates
- 🎨 Live preview of email changes with sample data
- 🔄 Reset templates to defaults
- 📧 Pre-populated with HumHub's default email content
- 💾 Database-backed template storage
- 🌍 Multi-language support ready
- **🎨 NEW: Visual Email Style Designer**
  - Customize email colors (primary, background, text, links, buttons)
  - HumHub's native rich text editor for headers and footers
  - Custom CSS editor for advanced styling
  - Logo URL configuration
  - Live preview with real-time updates
  - Export/import style configurations
  - Separate admin menu section

**Access the new features:**
   - Email Templates: Administration → Settings → Email Templates
   - Email Style Designer: Administration → Settings → Email Style Designer# HumHub Email Template Editor Plugin

## Installation

1. Download the plugin files
2. Extract to `protected/modules/emailtemplates/`
3. Enable the module in Administration → Modules
4. Configure templates in Administration → Settings → Email Templates

## Available Templates

1. **General Notification** - Standard notifications
2. **New Comment Notification** - When someone comments on content
3. **New Like Notification** - When someone likes content
4. **Space Invitation** - Inviting users to spaces
5. **User Invitation** - Inviting new users to the platform
6. **Password Recovery** - Password reset emails
7. **Welcome Email** - New user welcome messages
8. **New Follower Notification** - When someone follows you
9. **Mention Notification** - When someone mentions you

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

## Changelog

### Version 1.1.0 (Email Style Designer)
- **NEW: Visual Email Style Designer** - Complete email branding customization
- Visual HTML editor (TinyMCE) for headers and footers
- Color picker for 6 different email color schemes
- Custom CSS editor for advanced styling
- Logo URL configuration
- Live preview with real-time updates
- Export/import style configurations
- Separate admin menu section
- New database table for style storage
- Additional migration file

### Version 1.0.0 (Initial Release)
- Basic email template editing functionality
- Template selection interface
- Placeholder support with expanded placeholders
- Reset to defaults feature
- Database migration for template storage
- Admin menu integration
- Preview functionality with subject line
- Pre-populated with HumHub default email content
- 9 email templates included

### Updates in Version 1.1.0
- Added EmailStyle model for managing visual styles
- Added StyleController for style management
- New admin menu entry "Email Style Designer"
- TinyMCE integration for WYSIWYG editing
- Real-time preview with iframe
- Color picker inputs for easy color selection
- Export functionality for style backup
- Updated Events.php to include new menu entry
- Updated translations for new features

## Installation

### Option 1: Download ZIP File (Recommended)
1. Open the "HumHub Email Templates Plugin - Download Package" artifact
2. Click the "Download Complete Plugin (ZIP)" button
3. Extract the ZIP file - you'll get an `emailtemplates` folder
4. Copy the `emailtemplates` folder to `protected/modules/` in your HumHub installation
5. Run the migration:
   ```bash
   php yii migrate/up --migrationPath=@humhub/modules/emailtemplates/migrations
   ```
6. Enable the module in Administration → Modules
7. Configure templates in Administration → Settings → Email Templates

## File Structure

Navigate to **Administration → Settings → Email Templates** to:
- Select a template to edit
- Modify the subject and body
- Use available placeholders (e.g., {displayName}, {contentTitle})
- Preview your changes
- Save or reset to defaults

## File Structure

```
protected/modules/emailtemplates/
├── Module.php
├── Events.php
├── config.php
├── module.json
├── controllers/
│   ├── AdminController.php
│   └── StyleController.php          ← NEW
├── models/
│   ├── EmailTemplate.php
│   └── EmailStyle.php                ← NEW
├── migrations/
│   ├── m000000_000000_initial.php
│   └── m000000_000001_email_style.php  ← NEW
├── views/
│   ├── admin/
│   │   ├── index.php
│   │   ├── edit.php
│   │   └── preview.php
│   └── style/                        ← NEW
│       ├── index.php
│       └── preview.php
└── messages/
    └── en/
        └── base.php
```

## Usage

Navigate to **Administration → Settings → Email Templates** to:

### Version 1.0.0 (Initial Release)
- Basic email template editing functionality
- Template selection interface
- Placeholder support with expanded placeholders
- Reset to defaults feature
- Database migration for template storage
- Admin menu integration
- Preview functionality with subject line
- Pre-populated with HumHub default email content
- 9 email templates included

### Updates in this version
- Added default email subjects and bodies matching HumHub's current templates
- Expanded placeholder support: {siteName}, {author}, {originator}, {message}, etc.
- Preview now shows both subject and body
- More comprehensive template coverage
- **Fixed preview modal loading issues** - Now correctly loads the selected template
- **Added accessibility features** - ARIA labels, keyboard navigation support
- **Enhanced modal with Close button** - Better UX with visible close button and icon
- **Loading states** - Shows spinner while preview loads
- **Error handling** - Displays error message if preview fails to load
- **Modal cleanup** - Clears content when closed to prevent stale data
