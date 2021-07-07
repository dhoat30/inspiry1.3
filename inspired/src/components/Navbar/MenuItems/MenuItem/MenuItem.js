import React from 'react'
import { Link } from "gatsby"
import * as styles from './MenuItem.module.css'
function MenuItem(props) {

    const menuItemClasses = `${props.classes}`
    return (
        <React.Fragment>
            <li className={styles.linkItem}>
                <Link onClick={props.logout} className={menuItemClasses} to={props.link}>
                    {props.children}
                    {props.item}
                </Link >
            </li>


        </React.Fragment>
    )
}

export default MenuItem
