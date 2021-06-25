import DesignBoard from './DesignBoard';
import DesignBoardSaveBtn from './DesignBoardSaveBtn';

let $ = jQuery;




/* ajax call for design board */

class DesignBoardAjax {
    constructor() {
        // this.aTag = document.querySelectorAll('.design-board-card');

        this.events();
    }

    events() {


        // // this.aTag.forEach(e => {
        //     e.addEventListener('click', this.getBoards.bind(this));
        // })

        // windcave
        // this.windcave();

        this.createSession();
    }

    createSession() {
        var request = new XMLHttpRequest();

        request.open('POST', 'https://sec.windcave.com/api/v1/sessions');

        request.setRequestHeader('Content-Type', 'application/json');
        request.setRequestHeader('Authorization', '218acd1585026b9c32f3d5a3ac86f8e385cfd7610df480bc9086b25abd423477');

        request.onreadystatechange = function () {
            if (this.readyState === 4) {
                console.log('Status:', this.status);
                console.log('Headers:', this.getAllResponseHeaders());
                console.log('Body:', this.responseText);
            }
            else {
                console.log('request was successful')
                console.log(this.responseText)
            }
        };

        var body = {
            'type': 'purchase',
            'amount': '12345.00',
            'amountSurcharge': '1.50',
            'currency': 'NZD',
            'merchantReference': '1234ABC',
            'language': 'en',
            'methods': [
                'card',
                'account2account',
                'alipay',
                'applepay',
                'paypal',
                'interac',
                'unionpay',
                'oxipay',
                'visacheckout',
                'wechat'
            ],
            'expires': '2019-12-19T16:39:57-08:00',
            'callbackUrls': {
                'approved': 'https://myshop.com/success',
                'declined': 'https://myshop.com/fail',
                'cancelled': 'https://myshop.com/cancel'
            },
            'notificationUrl': 'https://mybiz.com/txn_result?123',
            'cardId': '32545243214',
            'storeCard': true,
            'storedCardIndicator': 'single',
            'installmentCount': 4,
            'installmentNumber': 1,
            'debtRepaymentIndicator': 0,
            'customer': {
                'firstName': 'John',
                'lastName': 'Doe',
                'email': 'john.doe@hosting.com',
                'phoneNumber': '+6421384236',
                'account': '9999999999999999',
                'shipping': {
                    'name': 'JOHN TT DOE',
                    'address1': '15 elsewhere lane',
                    'address2': '',
                    'address3': '',
                    'city': 'deliverytown',
                    'countryCode': 'NZ',
                    'postalCode': '90210',
                    'phoneNumber': '+43543435',
                    'state': ''
                },
                'billing': {
                    'name': 'JOHN TT DOE',
                    'address1': '15 elsewhere lane',
                    'address2': '',
                    'address3': '',
                    'city': 'deliverytown',
                    'countryCode': 'NZ',
                    'postalCode': '90210',
                    'phoneNumber': '+43543435',
                    'state': ''
                }
            },
            'metaData': [
                'ABC123'
            ],
            'browser': {
                'ipAddress': '123.123.123.123',
                'userAgent': 'Mozilla/5.0 Windows NT 10.0; Win64; x64; rv:59.0 Gecko/20100101 Firefox/59.0'
            }
        };

        request.send(JSON.stringify(body));
    }

    // getBoards(e) {
    //     e.preventDefault();
    //     //get a url 
    //     let url = $(e.target).closest('a').attr('href');


    //     //creat an xhr object 
    //     var xhr = new XMLHttpRequest();


    //     //send get request 
    //     xhr.open('GET', url, true);

    //     $(e.target).closest('a').append('<div class="loader-div" style="display:block"></div>');
    //     e.target.closest('a').querySelector('.loader-div').classList.add('loader-icon');

    //     //get results and show theme 
    //     xhr.onload = function () {
    //         e.target.closest('a').querySelector('.loader-div').classList.remove('loader-icon');
    //         $('.body-container').hide(300);
    //         $('.ajax-result').show(300);
    //         $('.ajax-result').append('<i class="fal fa-arrow-left"></i>');
    //         $('.ajax-result').append(this.responseText);
    //         const overlay = new DesignBoard();
    //         const restApiCalls = new DesignBoardSaveBtn();

    //         $('.fa-arrow-left').on('click', () => {
    //             console.log('clsoe icon');
    //             $('.body-container').show(300);
    //             $('.ajax-result').hide(300);
    //             $('.ajax-result').html(' ');
    //         })
    //     }
    //     //send request 
    //     xhr.send();





    // }

    // //add project to board
    // windcave() {
    //     // let body = JSON.parse('{  "type": "purchase", "methods": ["card"], "amount": "1.03", "currency": "NZD", "callbackUrls": { "approved": "https://localhost/success", "declined": "https://localhost/failure"}');
    //     console.log('windcave')
    //     $.ajax({
    //         beforeSend: (xhr) => {
    //             xhr.setRequestHeader('Content-Type', 'application/json')
    //         },
    //         url: 'https://sec.windcave.com/api/v1/sessions',
    //         type: 'POST',
    //         data: {
    //             name: 'Gurpreet'
    //         },
    //         complete: () => {
    //             console.log('comleted')
    //         },
    //         success: (response) => {
    //             console.log('this is a success area')
    //             if (response) {
    //                 console.log(response);

    //                 //fill heart
    //                 //  $('.design-board-save-btn-container i').addClass('fas fa-heart');

    //             }
    //         },
    //         error: (response) => {
    //             console.log('this is an error');
    //             console.log(response)

    //         }
    //     });


    // }

}


export default DesignBoardAjax;