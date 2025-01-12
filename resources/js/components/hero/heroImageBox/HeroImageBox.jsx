import React from "react";

import { HeroImage } from "../../../assets/images";

const HeroImageBox = () => {
	return (
		<div className='hero_image_section relative'>
			<img src={HeroImage} alt='hero_image' loading='lazy' />
		</div>
	);
};

export default HeroImageBox;
