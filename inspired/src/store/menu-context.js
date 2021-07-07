import React, { useState, useEffect } from 'react';
import Backdrop from '../components/UI/Backdrop/Backdrop';

const MenuContext = React.createContext({
    visibleRegisterForm: false,
    visible: (visibility) => { },
    backdrop: (value) => {
    },
    backdropVisibility: false,
    showMenuMobileCard: false,
    showMenuMobileCardFunction: (value) => { },
    showLoginModal: false,
    showLoginModalFunction: (boolValue) => { }

})

export const MenuContextProvider = (props) => {


    // landing page register form visibility
    const [registerFormVisible, setRegisterFormVisible] = useState(false)
    const [showBackdrop, setShowBackdrop] = useState(false)
    const [showMenu, setShowMenu] = useState(false)
    const [showLoginModal, setShowLoginModal] = useState(false)
    const registerVisiblityHandler = (visibility) => {
        setRegisterFormVisible(visibility)
    }
    const backdropHandler = (value) => {
        setShowBackdrop(value)
    }
    const showMenuHandler = (value) => {
        setShowMenu(value)
    }

    // login modal function 
    const showLoginModalHandler = (boolValue) => {
        setShowLoginModal(boolValue)
    }

    const menuContextValue = {
        visibleRegisterForm: registerFormVisible,
        visible: registerVisiblityHandler,
        backdrop: backdropHandler,
        backdropVisibility: showBackdrop,
        showMenuMobileCard: showMenu,
        showMenuMobileCardFunction: showMenuHandler,
        showLoginModal: showLoginModal,
        showLoginModalFunction: showLoginModalHandler
    }


    return <MenuContext.Provider value={menuContextValue}>{props.children}</MenuContext.Provider>
}


export default MenuContext;