import React, { useState } from 'react'
import MenuItem from './MenuItem/MenuItem'
import ProfileItems from './ProfileItems/ProfileItems'
import * as styles from './MenuItems.module.css'
function MenuItems(props) {
    const [showNavbar, setShowNavbar] = useState(true)
    const clickHandler = props => {
        setShowNavbar(false)
    }
    return (
        <React.Fragment>
            <div className={`${styles.menuContainer}`}>
                <ul className="flex-row">
                    <MenuItem item="shop" link="https://inspiry.co.nz/products" />
                    <MenuItem item="Trade" link="https://inspiry.co.nz" />
                    <MenuItem item="About" link="https://inspiry.co.nz/" />
                    <MenuItem item="blog" link="https://inspiry.co.nz/" />
                </ul>
                <div className="profileItems">
                    <ProfileItems profileName="Gupreet" registerClick={clickHandler} />

                </div>
            </div >
        </React.Fragment>


    )
}

export default MenuItems
