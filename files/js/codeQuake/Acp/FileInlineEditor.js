/**
 * Inline Editor for files.
 */
define(['Ajax', 'Language', 'Ui/Dialog', 'ObjectMap', 'Dom/Util', 'Core'], function (Ajax, Language, UiDialog, ObjectMap, DomUtil, Core) {
	"use strict";

	function FileDetails (options) {
		this.init(options);
	}

	FileDetails.prototype = {
		/**
		 * @param        {object}        options                list of initialization options
		 */
		init: function (options) {
			this._options = Core.extend({
				objectIDs: []
			}, options);
		},

		open: function () {
			Ajax.api(this, {
				parameters: this._options.parameters
			});
		},

		_ajaxSuccess: function (data) {
			UiDialog.open(this, data.returnValues.template);
			var submit = elBySel('.fileEditSubmit');
			submit.addEventListener(WCF_CLICK_EVENT, this._saveForm.bind(this, submit));
		},

		_saveForm: function () {
			var title = elBySel('input#title');
			var categoryIDsSelect = elBySel('select#categoryIDs');

			if (title == '' || categoryIDsSelect.selectedOptions.length == 0) {
				return;
			}

			var categoryIDs = [], i;
			for (i = 0; i < categoryIDsSelect.selectedOptions.length; i++) {
				categoryIDs.push(categoryIDsSelect.selectedOptions[i].value);
			}

			Ajax.apiOnce({
				data: {
					actionName: 'update',
					className: 'cms\\data\\file\\FileAction',
					objectIDs: this._options.objectIDs,
					parameters: {
						data: {
							title: (title == undefined) ? '' : title.value
						},
						categoryIDs: categoryIDs
					}
				},
				success: function () {
					window.location.reload();
				},
				failure: function () {
					elBySel('.formSubmit');
				}
			});
		},

		_ajaxSetup: function () {
			return {
				data: {
					actionName: 'getDetails',
					className: 'cms\\data\\file\\FileAction',
					objectIDs: this._options.objectIDs
				}
			};
		},

		_dialogSetup: function () {
			return {
				id: DomUtil.getUniqueId(),
				options: {
					title: Language.get('cms.acp.file.edit')
				},
				source: null
			};
		}
	};

	function FileInlineEditor () {
		this.init();
	}

	FileInlineEditor.prototype = {
		_fileID: null,

		init: function () {
			this._details = new ObjectMap();

			var element, elements = elBySelAll('.jsFileDetails');
			for (var i = 0, length = elements.length; i < length; i++) {
				element = elements[i];
				element.addEventListener(WCF_CLICK_EVENT, this._showDetails.bind(this, element));
			}
		},

		_showDetails: function (element, event) {
			event.preventDefault();

			if (!this._details.has(element)) {
				var fileID = elData(element, 'file-id');
				this._details.set(element, new FileDetails({
					objectIDs: [fileID]
				}));
			}

			this._details.get(element).open();
		}
	};

	return FileInlineEditor;
});
