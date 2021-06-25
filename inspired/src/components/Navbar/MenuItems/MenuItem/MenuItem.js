import React from 'react'
import { Link } from "gatsby"
import * as styles from './MenuItem.module.css'
function MenuItem(props) {
    return (
        <React.Fragment>
            <li className={styles.linkItem}>
                <Link to={props.link}>
                    {props.item}
                </Link >
            </li>


        </React.Fragment>
    )
}

export default MenuItem
