import React, { useState } from 'react'
import Backdrop from '../Backdrop/Backdrop'
import * as styles from './RegisterModal.module.css'
import LargeTitle from '../Content/Titles/LargeTitle';
import ILogo from '../Logo/ILogo/ILogo';
import ColumnTitle from '../Content/Titles/ColumnTitle';
import Paragraph from '../Content/Paragraph/Paragraph';
import Input from '../Input/Input';
import Errors from '../Notifications/Errors/Errors';

function RegisterModal() {

    const [email, setEmail] = useState('')
    // const [enteredEmailIsValid, setEnteredEmailIsValid] = useState(false)
    const [enteredEmailTouched, setEnteredEmailTouched] = useState(false)

    let enteredEmailIsValid = false
    const emailInputIsInvalid = !enteredEmailIsValid && enteredEmailTouched

    // input change handler
    const emailChangeHandler = (event) => {
        // validate email
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        let emailValue = event.target.value

        if (pattern.test(emailValue)) {
            enteredEmailIsValid = true
            setEmail(emailValue)

        }
        else {
            enteredEmailIsValid = false
            setEnteredEmailTouched(true)

        }

    }

    const blurHandler = (event) => {
        if (event.target.value.trim() === '') {
            enteredEmailIsValid = false
            setEnteredEmailTouched(true)
        }
    }
    const passwordChangeHandler = (event) => {
        console.log(event.target.value)
    }
    const formSubmissionHandler = (event) => {
        event.preventDefault()
        if (email.trim() === '') {
            setEnteredEmailTouched(true)
        }
    }


    return (
        <div className={`${styles.logInModalContainer} card-border-radius`}>
            <Backdrop show={true} />
            <LargeTitle color="white">Register to get your ideas</LargeTitle>
            <div className={`${styles.logInModal} card-border-radius flex-column align-center justify-center`}>
                <ILogo classes="margin-element-v" />
                <ColumnTitle color="dark-grey" fontWeight="semi-bold" textAlign="center-align">Be Inspired</ColumnTitle>
                <Paragraph color="dark-grey" fontWeight="regular">Find new ideas to try</Paragraph>

                <form className={`${styles.loginForm}`} onSubmit={formSubmissionHandler}>
                    <Input type="text" placeholder="Email" id="email" name="email" blurChange={blurHandler} inputChange={emailChangeHandler} isInvalid={emailInputIsInvalid} />
                    {emailInputIsInvalid ? <Errors>Entered email address is not valid</Errors> : null}

                    {/* <Input type="password" placeholder="Create a password" id="password" name="password" inputChange={passwordChangeHandler} /> */}
                    <button>Submit</button>
                </form>
            </div>
        </div>
    )
}

export default RegisterModal
