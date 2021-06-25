import React, { useState } from 'react'
import MenuItems from './MenuItems/MenuItems'
import { useMediaQuery } from 'react-responsive'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faBars, faTimes } from '@fortawesome/pro-light-svg-icons'

function Navbar(props) {

    const isTablet = useMediaQuery({ query: '(max-width: 1064px)' })
    const [showMenu, setShowMenu] = useState(isTablet)

    const clickHandler = () => {
        setShowMenu(false)
    }
    const closeHandler = () => {
        setShowMenu(true)
    }

    let icon
    if (isTablet) {
        icon = showMenu ? <FontAwesomeIcon icon={faBars} size="lg" onClick={clickHandler} /> : <FontAwesomeIcon icon={faTimes} size="lg" onClick={closeHandler} />;
    }

    return (
        <React.Fragment>
            {icon}
            {!showMenu ? <MenuItems /> : null}
        </React.Fragment>
    )
}

export default Navbar
