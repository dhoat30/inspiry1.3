import React from 'react'
import { StaticImage } from 'gatsby-plugin-image'
function ILogo(props) {
    console.log(props.imgWidth)
    return (
        <div>
            <StaticImage
                src="./ILogo-2.png"
                width={25}
                quality={95}
                formats={["AUTO", "WEBP", "AVIF"]}
                alt="A Gatsby astronaut"
                className={props.classes}
            />
        </div>
    )
}

export default ILogo
