# Helpers and Tools

For everyone interested.


## TOOLS
### Available tools
* `text/word-counter` - Counts words


## INTEGRATION
### Wordpress
1. Create new folder in `/wp-content/plugins`
2. Copy `integration/wp-shortcode.php` inside OR create symbolic link
3. Enable plugin in dashboard/plugins
4. Use Shortcode `[cbp_tool tool="PATH_TO_THE_TOOL"]`

example:
`[cbp_tool tool="text/word-counter"]`
