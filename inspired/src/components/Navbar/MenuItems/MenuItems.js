import React from 'react'
import MenuItem from './MenuItem/MenuItem'
import ProfileItems from './ProfileItems/ProfileItems'
import * as styles from './MenuItems.module.css'
function MenuItems(props) {
    return (

        <div className={`${styles.menuContainer}`}>
            <ul className="flex-row">
                <MenuItem item="shop" link="https://inspiry.co.nz/products" />
                <MenuItem item="Trade" link="https://inspiry.co.nz" />
                <MenuItem item="About" link="https://inspiry.co.nz/" />
                <MenuItem item="blog" link="https://inspiry.co.nz/" />
            </ul>
            <div className="profileItems">
                <ProfileItems profileName="Gupreet" />

            </div>
        </div>

    )
}

export default MenuItems
