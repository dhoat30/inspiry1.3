import React, { useState } from 'react';
import ILogo from './ILogo/ILogo'
import { StaticImage } from 'gatsby-plugin-image'
import * as styles from './Logo.module.css'

function Logo(props) {
    const [showILogo, setILogo] = useState(props.showIcon ? true : false);

    return (
        <div className={styles.container}>
            {showILogo ? <ILogo ></ILogo> : null}
            <StaticImage className={styles.logo}
                src="https://inspiry.co.nz/wp-content/uploads/2020/11/Inspiry_Logo-transparent-1.png"
                width={120}
                quality={95}
                formats={["AUTO", "WEBP", "AVIF"]}
                alt="A Gatsby astronaut"
                layout="fixed"
            />
        </div>
    )
}

export default Logo
