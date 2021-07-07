import React, { useContext } from 'react'
import AuthContext from '../../store/auth-context'
import LoggedIn from '../LoggedIn/LoggedIn'
import LoggedOut from '../LoggedOut/LoggedOut'

function HomePage() {
    const authCtx = useContext(AuthContext)
    return (
        <React.Fragment>
            {authCtx.isLoggedIn ? <LoggedIn /> : <LoggedOut />}
        </React.Fragment>
    )
}

export default HomePage
