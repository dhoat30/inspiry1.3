import React from 'react'
import { StaticImage } from 'gatsby-plugin-image'
function ILogo() {
    return (
        <div>
            <StaticImage
                src="./ILogo-2.png"
                width={25}
                quality={95}
                formats={["AUTO", "WEBP", "AVIF"]}
                alt="A Gatsby astronaut"

            />
        </div>
    )
}

export default ILogo
