import React from "react";
import { AddsImage } from "../../../../../assets/images/blog";

const AdsBox = ({ className }) => {
	return (
		<div className={`${className} md:h-[310px] h-[268.667px] md:self-stretch`}>
			<img className='w-full' src={AddsImage} alt='ads ' loading='lazy' />
		</div>
	);
};

export default AdsBox;
