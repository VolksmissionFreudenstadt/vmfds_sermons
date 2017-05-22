/*
 * @package vmfds_sermons
 * @copyright Copyright (c) 2012-2016 Volksmission Freudenstadt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License v3 or later
 * @site http://open.vmfds.de
 * @author Christoph Fischer <chris@toph.de>
 * @date 2016-06-04
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
$(document).ready(function() {
            $("#fileuploader").uploadFile({
                url: uploadUrl,
                fileName: 'tx_vmfdssermons_sermons[audiorecording]',
                downloadStr: 'Hochladen',
                cancelStr: 'Abbrechen',
                abortStr: 'Abbrechen',
                doneStr: 'Fertig',
                dragDropStr: "<span><b>... oder eine Datei hierher ziehen.</b></span>",
                maxFileCount: 1,
                maxFileSize: 100 * 1024 * 1024,
                multiple: false,
                showProgress: true,
                dynamicFormData: function() {
                    var data = {
                        'tx_vmfdssermons_sermons[__referrer][@extension]': 'VmfdsSermons',
                        'tx_vmfdssermons_sermons[__referrer][@vendor]': 'TYPO3',
                        'tx_vmfdssermons_sermons[__referrer][@controller]': 'Sermon',
                        'tx_vmfdssermons_sermons[__referrer][@action]': 'audioUploadWelcome',
                        'tx_vmfdssermons_sermons[__referrer][arguments]': $("input[name='tx_vmfdssermons_sermons[__referrer][arguments]']").val(),
                        'tx_vmfdssermons_sermons[__trustedProperties]': $("input[name='tx_vmfdssermons_sermons[__trustedProperties]']").val(),
                        'tx_vmfdssermons_sermons[sermon]': $("select[name='tx_vmfdssermons_sermons[sermon]']").val()
                    }
                    $("select[name='tx_vmfdssermons_sermons[sermon]']").prop('disabled', true);
                    $('.ajax-upload-dragdrop').hide();
                    return data;
                },
                afterUploadAll: function() {
                    window.location.href = afterUploadUrl;
                }
            });
            $('#audiorecording').hide();
            $('#origUploadButton').hide();
        });