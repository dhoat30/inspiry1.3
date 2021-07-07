import React, { useState, useContext } from 'react'
import MenuItems from './MenuItems/MenuItems'
import { useMediaQuery } from 'react-responsive'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faBars, faTimes } from '@fortawesome/pro-light-svg-icons'
import MenuContext from '../../store/menu-context'

function Navbar(props) {
    const menuCtx = useContext(MenuContext)
    console.log(menuCtx)
    const isTablet = useMediaQuery({ query: '(max-width: 1064px)' })
    // const [showMenu, setShowMenu] = useState(isTablet)

    const clickHandler = () => {
        // setShowMenu(false)
        menuCtx.showMenuMobileCardFunction(true)
    }
    const closeHandler = () => {

        menuCtx.showMenuMobileCardFunction(false)

    }

    let icon
    if (isTablet) {
        icon = !menuCtx.showMenuMobileCard ? <FontAwesomeIcon icon={faBars} size="lg" onClick={clickHandler} /> : <FontAwesomeIcon icon={faTimes} size="lg" onClick={closeHandler} />;
    }

    return (
        <React.Fragment>
            {icon}
            {menuCtx.showMenuMobileCard || !isTablet ? <MenuItems /> : null}

        </React.Fragment>
    )
}

export default Navbar
