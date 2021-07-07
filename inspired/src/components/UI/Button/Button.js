import React from 'react'
import * as styles from './Button.module.css';

function Button(props) {
    let backgroundClasses
    if (props.backgroundColor === 'darkGrey') {
        backgroundClasses = `${styles.button} ${styles.buttonDarkGrey} bold`
    }
    if (props.backgroundColor === 'beige') {
        backgroundClasses = `${styles.button} ${styles.buttonBiegeColor} bold`
    }
    return (
        <React.Fragment>
            <button className={`${backgroundClasses} ${props.width}`} onClick={props.buttonClick}>{props.title}{props.children}</button>
        </React.Fragment >
    )
}

export default Button
