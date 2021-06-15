import { data } from "jquery";

const $ = jQuery;
class Form {
    constructor() {
        this.enquiryForm = $('#enquiry-form');
        this.events();
    }

    events() {
        this.enquiryForm.on('submit', this.enquiryFormProcessor.bind(this));

    }

    enquiryFormProcessor(e) {
        let dataObj = this.getFormData(e, '#enquiry-form');
        this.sendRequest(dataObj, 'form-processor', '#enquiry-form');
    }


    // send request function
    sendRequest(dataObj, fileName, formID) {
        console.log(dataObj);
        const jsonData = JSON.stringify(dataObj);
        let xhr = new XMLHttpRequest();
        let url = window.location.hostname;
        let filePath;

        if (url === 'localhost') {
            filePath = `/inspiry/${fileName}`
        }
        else {
            filePath = `https://inspiry.co.nz/${fileName}`
        }

        xhr.open('POST', filePath);

        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = function () {
            $(`${formID} p`).html('');
            if (xhr.status == 200) {
                console.log(xhr);
                $($(formID).prop('elements')).each(function (i) {
                    if (this.value !== 'Submit') {
                        this.value = "";
                        // uncheck the checked box 
                        $('#newsletter').prop('checked', false);
                    }
                });

                $(formID).append('<p class="success-msg paragraph regular">Thanks for contacting us!</p>');
                setTimeout(() => {
                    $('.enquiry-form-section').hide();
                    $('.overlay').hide();
                }, 2000);
            }
            else {
                console.log('this is an error')
                $(formID).append('<p class="error-msg paragraph regular">Something went wrong. Please try again!</p>');
            }
        }

        xhr.send(jsonData);
    }

    getFormData(e, formID) {

        e.preventDefault();

        var dataObj = {};
        $($(formID).prop('elements')).each(function (i) {
            dataObj[$(this).attr('name')] = this.value;
        });
        // check if the checkbox is checked 
        if ($('#enquiry-form #newsletter:checked').length > 0) {
            dataObj.newsletter = 'Yes';
        }
        else {
            dataObj.newsletter = 'No';
        }

        // send custom data
        let productID = $(this.enquiryForm).data('id');
        let productName = $(this.enquiryForm).data('name');
        if (productID && productName) {
            dataObj.productID = productID;
            dataObj.productName = productName;
        }

        return dataObj;
    }

}

export default Form;