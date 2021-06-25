import React, { useState } from 'react'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faChevronDown } from '@fortawesome/pro-light-svg-icons'
import * as styles from './ProfileItems.module.css'
import { Link } from 'gatsby'
import Button from '../../../UI/Button/Button'

function ProfileItems(props) {
    const [signedIn, setSignedIn] = useState(false);

    let profileBar;
    if (signedIn) {
        profileBar = (<ul className={styles.profileItemsContainer}>
            <li className="beige-color-bc ">
                <Link to="https://inspiry.co.nz/" >{props.profileName.charAt(0)} </Link>
            </li>
            <li><FontAwesomeIcon icon={faChevronDown} /></li>
        </ul>);
    }
    else {
        profileBar = (<ul className={styles.profileItemsContainer}>
            <Button title="Log in" backgroundColor="darkGrey" />
            <Button title="Register" backgroundColor="beige" />
        </ul>);
    }
    return (
        <React.Fragment>
            {profileBar}
        </React.Fragment>

    )
}

export default ProfileItems
