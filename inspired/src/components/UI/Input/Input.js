import React from 'react'
import * as styles from './Input.module.css'
function Input(props) {
    const inputClasses = props.isInvalid ? `${styles.input} ${styles.invalid} card-border-radius` : `${styles.input} card-border-radius`
    return (
        <React.Fragment >
            <input className={inputClasses}
                type={props.type}
                placeholder={props.placeholder}
                id={props.id}
                name={props.name}
                onChange={props.inputChange}
                onBlur={props.blurChange}
                value={props.value}
            />

        </React.Fragment>
    )
}

export default Input
