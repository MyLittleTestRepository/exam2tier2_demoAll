<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Furniture company");
?><?$APPLICATION->IncludeComponent("bitrix:news.list", "newslist", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "news",	// Type of information block (used for verification only)
		"IBLOCK_ID" => "1",	// Information block code
		"NEWS_COUNT" => "20",	// News per page
		"SORT_BY1" => "ACTIVE_FROM",	// Field for the news first sorting pass
		"SORT_ORDER1" => "DESC",	// Direction for the news first sorting pass
		"SORT_BY2" => "SORT",	// Field for the news second sorting pass
		"SORT_ORDER2" => "ASC",	// Direction for the news second sorting pass
		"FILTER_NAME" => "",	// Filter
		"FIELD_CODE" => array(	// Fields
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(	// Properties
			0 => "ENG_PREVIEW_TEXT",
			1 => "ENG_NAME",
			2 => "",
		),
		"CHECK_DATES" => "Y",	// Show only currently active elements
		"DETAIL_URL" => "",	// Detail page URL (from information block settings by default)
		"AJAX_MODE" => "N",	// Enable AJAX mode
		"AJAX_OPTION_JUMP" => "N",	// Enable scrolling to component's top
		"AJAX_OPTION_STYLE" => "Y",	// Enable styles loading
		"AJAX_OPTION_HISTORY" => "N",	// Emulate browser navigation
		"AJAX_OPTION_ADDITIONAL" => "",	// Additional ID
		"CACHE_TYPE" => "A",	// Cache type
		"CACHE_TIME" => "36000000",	// Cache time (sec.)
		"CACHE_FILTER" => "N",	// Cache if the filter is active
		"CACHE_GROUPS" => "Y",	// Respect Access Permissions
		"PREVIEW_TRUNCATE_LEN" => "",	// Maximum preview text length (for Text type only)
		"ACTIVE_DATE_FORMAT" => "m/d/Y",	// Date display format
		"SET_TITLE" => "Y",	// Set page title
		"SET_BROWSER_TITLE" => "Y",	// Set browser window title
		"SET_META_KEYWORDS" => "Y",	// Set page keywords
		"SET_META_DESCRIPTION" => "Y",	// Set page description
		"SET_LAST_MODIFIED" => "N",	// Set page last modified date to response header
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Include information block into navigation chain
		"ADD_SECTIONS_CHAIN" => "Y",	// Add Section name to breadcrumb navigation
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Hide link to the details page if no detailed description provided
		"PARENT_SECTION" => "",	// Section ID
		"PARENT_SECTION_CODE" => "",	// Section code
		"INCLUDE_SUBSECTIONS" => "Y",	// Show elements from subsections
		"STRICT_SECTION_CHECK" => "N",	// Check parent section when showing list
		"DISPLAY_DATE" => "Y",	// Display element date
		"DISPLAY_NAME" => "Y",	// Display element title
		"DISPLAY_PICTURE" => "Y",	// Display element preview picture
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Display element preview text
		"PAGER_TEMPLATE" => ".default",	// Breadcrumb navigation template
		"DISPLAY_TOP_PAGER" => "N",	// Display at the top of the list
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Display at the bottom of the list
		"PAGER_TITLE" => "News",	// Category name
		"PAGER_SHOW_ALWAYS" => "N",	// Always show the pager
		"PAGER_DESC_NUMBERING" => "N",	// Use reverse page navigation
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Cache time for pages with reverse page navigation
		"PAGER_SHOW_ALL" => "N",	// Show the ALL link
		"PAGER_BASE_LINK_ENABLE" => "N",	// Enable link processing
		"SET_STATUS_404" => "N",	// Set status 404
		"SHOW_404" => "N",	// Show page
		"MESSAGE_404" => "",	// Show this message (a component provided message is used by default)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>