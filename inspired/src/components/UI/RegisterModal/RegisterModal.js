import React, { useState, useContext } from 'react'
import Backdrop from '../Backdrop/Backdrop'
import * as styles from './RegisterModal.module.css'
import LargeTitle from '../Content/Titles/LargeTitle';
import ILogo from '../Logo/ILogo/ILogo';
import ColumnTitle from '../Content/Titles/ColumnTitle';
import Paragraph from '../Content/Paragraph/Paragraph';
import RegisterForm from './RegisterForm/RegisterForm';

function RegisterModal(props) {
    console.log('classes ')
    console.log(props.visibleClasses)
    const visibleClass = props.visibleClasses ? `${styles.visible}` : `${styles.invisible}`
    return (
        <React.Fragment>

            <div className={`${styles.registerModalContainer} card-border-radius ${visibleClass}`}>
                <LargeTitle color="white" fontWeight="semi-bold">Register to get your ideas</LargeTitle>
                <div id="registeration-form" className={`${styles.logInModal} card-border-radius flex-column align-center justify-center`}>
                    <ILogo classes="margin-element-v" />
                    <ColumnTitle color="dark-grey" fontWeight="semi-bold" textAlign="center-align">Be Inspired</ColumnTitle>
                    <Paragraph color="dark-grey" fontWeight="regular">Find new ideas to try</Paragraph>
                    <RegisterForm closeModal={props.closeModal} />

                </div>
            </div>
        </React.Fragment>

    )
}

export default RegisterModal
