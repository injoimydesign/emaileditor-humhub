# Email Style Designer - Color Variables Guide

## Overview

The Email Style Designer allows you to use color variables in your email header, footer, and custom CSS. These variables are automatically replaced with the actual color values you configure in the Color Settings section.

---

## Available Color Variables

### 1. `{primary_color}`
- **Default:** `#3498db` (Blue)
- **Usage:** Main brand color for headers, highlights, and primary elements
- **Example:**
  ```html
  <div style="background-color: {primary_color}; padding: 20px;">
      Header Content
  </div>
  ```

### 2. `{background_color}`
- **Default:** `#f4f4f4` (Light Gray)
- **Usage:** Overall email background color
- **Example:**
  ```html
  <body style="background-color: {background_color};">
  ```

### 3. `{text_color}`
- **Default:** `#333333` (Dark Gray)
- **Usage:** Primary text color for body content
- **Example:**
  ```html
  <p style="color: {text_color};">Your message here</p>
  ```

### 4. `{link_color}`
- **Default:** `#3498db` (Blue)
- **Usage:** Hyperlink color
- **Example:**
  ```html
  <a href="#" style="color: {link_color};">Click here</a>
  ```

### 5. `{button_color}`
- **Default:** `#3498db` (Blue)
- **Usage:** Call-to-action button background color
- **Example:**
  ```html
  <a href="#" style="background-color: {button_color}; color: {button_text_color}; padding: 10px 20px; display: inline-block;">
      Click Me
  </a>
  ```

### 6. `{button_text_color}`
- **Default:** `#ffffff` (White)
- **Usage:** Text color for buttons
- **Example:**
  ```html
  <button style="color: {button_text_color};">Submit</button>
  ```

---

## Where Can You Use Color Variables?

### ✅ Email Header HTML
Use color variables in your header to create branded email headers:

```html
<div style="text-align: center; padding: 20px; background-color: {primary_color};">
    <img src="{logo_url}" alt="{siteName}" style="max-width: 200px;">
</div>
```

### ✅ Email Footer HTML
Use color variables in your footer for consistent styling:

```html
<div style="text-align: center; padding: 20px; background-color: {background_color};">
    <p style="color: {text_color};">© 2025 {siteName}</p>
    <a href="{unsubscribe_url}" style="color: {link_color};">Unsubscribe</a>
</div>
```

### ✅ Custom CSS
Use color variables in your CSS classes:

```css
.email-container {
    background-color: {background_color};
    color: {text_color};
}

.email-button {
    background-color: {button_color};
    color: {button_text_color};
    padding: 12px 24px;
    border-radius: 4px;
}

.email-link {
    color: {link_color};
    text-decoration: none;
}

.highlight-box {
    border-left: 4px solid {primary_color};
    padding: 10px;
    background-color: {background_color};
}
```

---

## Complete Examples

### Example 1: Branded Header with Logo
```html
<table style="width: 100%; background-color: {primary_color};">
    <tr>
        <td style="text-align: center; padding: 30px;">
            <img src="{logo_url}" alt="{siteName}" style="max-width: 250px; height: auto;">
            <h1 style="color: {button_text_color}; margin-top: 10px;">Welcome to {siteName}</h1>
        </td>
    </tr>
</table>
```

### Example 2: Footer with Social Links
```html
<table style="width: 100%; background-color: {background_color}; padding: 20px;">
    <tr>
        <td style="text-align: center;">
            <p style="color: {text_color}; margin: 0 0 10px 0;">
                © 2025 {siteName}. All rights reserved.
            </p>
            <p style="margin: 0;">
                <a href="{unsubscribe_url}" style="color: {link_color}; text-decoration: none; margin: 0 10px;">
                    Unsubscribe
                </a>
                <a href="{settings_url}" style="color: {link_color}; text-decoration: none; margin: 0 10px;">
                    Preferences
                </a>
            </p>
        </td>
    </tr>
</table>
```

### Example 3: Call-to-Action Button
```html
<table style="width: 100%;">
    <tr>
        <td style="text-align: center; padding: 20px;">
            <a href="#" style="
                background-color: {button_color};
                color: {button_text_color};
                padding: 15px 30px;
                text-decoration: none;
                border-radius: 5px;
                display: inline-block;
                font-weight: bold;
            ">
                Get Started Now
            </a>
        </td>
    </tr>
</table>
```

### Example 4: Content Box with Border
```html
<div style="
    border: 2px solid {primary_color};
    border-radius: 8px;
    padding: 20px;
    background-color: {background_color};
    margin: 20px 0;
">
    <h3 style="color: {primary_color}; margin-top: 0;">Important Update</h3>
    <p style="color: {text_color};">
        Your content here with proper text color.
    </p>
    <a href="#" style="color: {link_color};">Learn More →</a>
</div>
```

---

## Other Available Variables

In addition to color variables, you can also use:

### Site Variables
- `{siteName}` - Your site name
- `{logo_url}` - Your logo URL
- `{unsubscribe_url}` - Unsubscribe link (footer only)
- `{settings_url}` - Email settings link (footer only)

---

## Best Practices

### ✅ DO:
- Use color variables for consistency across all emails
- Test your emails after changing colors
- Use high contrast combinations (e.g., dark text on light background)
- Keep accessibility in mind (readable text colors)

### ❌ DON'T:
- Hardcode color values when a variable exists
- Use colors that clash or have poor contrast
- Forget to test in different email clients
- Use too many different colors (stick to your palette)

---

## Testing Your Colors

After configuring colors:
1. Click "Update Preview" to see changes in real-time
2. Test with different color combinations
3. Check readability and contrast
4. Send test emails to verify appearance in email clients

---

## Troubleshooting

### Colors Not Showing?
- Make sure you're using the correct variable format: `{color_name}`
- Check that there are no typos in variable names
- Verify colors are saved in the Color Settings section
- Clear browser cache and reload

### Preview Not Updating?
- Click the "Update Preview" button manually
- Check browser console for JavaScript errors
- Ensure all color values are valid hex codes (#RRGGBB)

---

## Need Help?

If you need assistance with color variables:
1. Check the examples in this guide
2. Use the live preview to test changes
3. Refer to the hints in the Email Style Designer interface
4. Test thoroughly before deploying to production

---

**Happy Designing! 🎨**
