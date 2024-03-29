import React, { useState, useEffect } from 'react';

const AuthContext = React.createContext({
    token: '',
    isLoggedIn: false,
    login: (token) => { },
    logout: () => {
    }
})

export const AuthContextProvider = (props) => {
    let initialToken

    initialToken = localStorage.getItem('token')
    const [token, setToken] = useState(initialToken)

    // landing page register form visibility

    const userIsLoggedIn = !!token
    const loginHandler = (token) => {
        setToken(token)
        localStorage.setItem('token', token)
    }
    const logOutHandler = () => {
        setToken(null)
        localStorage.removeItem('token')
    }


    const contextValue = {
        token: token,
        isLoggedIn: userIsLoggedIn,
        login: loginHandler,
        logout: logOutHandler,
    }

    return <AuthContext.Provider value={contextValue}>{props.children}</AuthContext.Provider>
}


export default AuthContext;