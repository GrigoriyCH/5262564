/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 //config.language = 'en';
	    config.scayt_autoStartup = false;
		config.disableNativeSpellChecker = false;
		config.removePlugins = 'scayt,contextmenu';
	 //config.uiColor = '#FF8C00';
	    //config.uiColor = '#c07203';
	config.removeButtons = 'Source,Save,NewPage,Preview,Print,Templates,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Anchor,About,PageBreak,SpellChecker,Language';
	config.skin = 'icy_orange';
	config.extraPlugins = 'youtube,spoiler';	
	
	//config.removePlugins = 'elementspath';
	//config.resize_enabled = false;
	//config.extraPlugins = 'autogrow';
};
