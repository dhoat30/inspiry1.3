import React from 'react'
import * as styles from './Errors.module.css'
function Errors(props) {
    return (
        <p className={`${styles.error} small-size`}>{props.children}</p>
    )
}

export default Errors
