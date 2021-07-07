import React, { useState, useContext } from 'react'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faChevronDown, faChevronUp } from '@fortawesome/pro-light-svg-icons'
import * as styles from './ProfileItems.module.css'
import { Link } from 'gatsby'
import Button from '../../../UI/Button/Button'
import Backdrop from '../../../UI/Backdrop/Backdrop'
import MenuContext from '../../../../store/menu-context'
import AuthContext from '../../../../store/auth-context'
import ProfileModal from './ProfileModal/ProfileModal'
function ProfileItems(props) {
    const authCtx = useContext(AuthContext)
    const menuCtx = useContext(MenuContext)

    // arrow click state
    const [isArrowShown, setIsArrowShown] = useState(false)
    const [isUpArrowShown, setIsUpArrowShown] = useState(false)

    // click handler
    const registerClickHandler = () => {
        menuCtx.visible(true)
        menuCtx.backdrop(true)
        menuCtx.showMenuMobileCardFunction(false)
    }
    const loginClickHandler = () => {
        menuCtx.showLoginModalFunction(true)
        console.log('log in')
    }

    const logoutClickHandler = () => {
        authCtx.logout()
    }

    const arrowClickHandler = () => {
        setIsArrowShown(true);
        setIsUpArrowShown(true)
    }
    const upArrowClickHandler = () => {
        setIsArrowShown(false);
        setIsUpArrowShown(false)
    }

    let profileBar;
    if (authCtx.isLoggedIn) {
        profileBar = (<ul className={styles.profileItemsContainer}>
            <li className="beige-color-bc ">
                <Link to="https://inspiry.co.nz/" >{props.profileName.charAt(0)} </Link>
            </li>
            <li>{!isUpArrowShown ? <FontAwesomeIcon icon={faChevronDown} onClick={arrowClickHandler} /> : <FontAwesomeIcon icon={faChevronUp} onClick={upArrowClickHandler} />}</li>
        </ul>);
    }
    else {
        profileBar = (<ul className={styles.profileItemsContainer}>
            <Button title="Log in" backgroundColor="darkGrey" buttonClick={loginClickHandler} />
            <a href="#registeration-form" onClick={registerClickHandler} > <Button title="Register" backgroundColor="beige" /></a>

        </ul>);
    }
    return (
        <React.Fragment>
            {profileBar}
            {isArrowShown && authCtx.isLoggedIn ? <ProfileModal logout={logoutClickHandler} /> : null}
        </React.Fragment>

    )
}

export default ProfileItems
