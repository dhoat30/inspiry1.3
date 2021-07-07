import React from 'react'
import * as styles from './Backdrop.module.css'
function Backdrop(props) {
    return (
        <React.Fragment>
            {props.show ? <div className={`${styles.backdrop} `} onClick={props.clicked}>
            </div> : null}
        </React.Fragment>
    )
}

export default Backdrop
