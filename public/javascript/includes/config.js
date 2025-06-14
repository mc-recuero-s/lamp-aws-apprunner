/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

 CKEDITOR.editorConfig = function( config ) {
 	// Define changes to default configuration here.
 	// For complete reference see:
 	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

 	// The toolbar groups arrangement, optimized for a single toolbar row.

 	config.toolbarGroups = [
    { name: 'document', groups: [ 'document' ] },
  		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
  		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ] },
  		{ name: 'insert', groups: [ 'insert' ] },
  		{ name: 'styles', groups: [ 'styles' ] },
  		{ name: 'colors', groups: [ 'colors' ] },
  		{ name: 'tools', groups: [ 'tools' ] },

 	];
 	// config.toolbarGroups = [
  //   { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
  // 		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
  // 		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
  // 		{ name: 'forms', groups: [ 'forms' ] },
  // 		'/',
  // 		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
  // 		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
  // 		{ name: 'links', groups: [ 'links' ] },
  // 		{ name: 'insert', groups: [ 'insert' ] },
  // 		'/',
  // 		{ name: 'styles', groups: [ 'styles' ] },
  // 		{ name: 'colors', groups: [ 'colors' ] },
  // 		{ name: 'tools', groups: [ 'tools' ] },
  // 		{ name: 'others', groups: [ 'others' ] },
  // 		{ name: 'about', groups: [ 'about' ] }
 	// ];

 	// The default plugins included in the basic setup define some buttons that
 	// are not needed in a basic editor. They are removed here.
 	config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript';

 	// Dialog windows are also simplified.
 	config.removeDialogTabs = 'link:advanced';
 };
