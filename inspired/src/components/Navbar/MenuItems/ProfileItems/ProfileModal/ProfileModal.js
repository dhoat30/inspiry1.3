import React from 'react'
import MenuItem from '../../MenuItem/MenuItem'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faSignOut, faPlus, faUser, faHistory } from '@fortawesome/pro-light-svg-icons'
import * as styles from './ProfileModal.module.css'
function ProfileModal(props) {
    return (
        <div className={`${styles.profileModalContainer} box-shadow`}>
            <MenuItem classes='paragraph-size ' item="Design Boards " link="https://inspiry.co.nz/products"><FontAwesomeIcon icon={faPlus} /></MenuItem>
            <MenuItem classes='paragraph-size' item="Order History" link="https://inspiry.co.nz/products"><FontAwesomeIcon icon={faHistory} /></MenuItem>
            <MenuItem classes='paragraph-size' item="Edit Profile" link="https://inspiry.co.nz/products"><FontAwesomeIcon icon={faUser} /></MenuItem>
            <MenuItem logout={props.logout} classes='paragraph-size' item="Log out" link="#"><FontAwesomeIcon icon={faSignOut} /></MenuItem>

        </div>
    )
}

export default ProfileModal
