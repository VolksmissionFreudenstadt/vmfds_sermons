$(document).ready(function() {
            $("#fileuploader").uploadFile({
                url: '<f:uri.action controller="Sermon" action="audioUploadDone" />',
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
                    window.location.href = '<f:uri.action controller="Sermon" action="audioUploadWelcome" />';
                }
            });
            $('#audiorecording').hide();
            $('#origUploadButton').hide();
        });