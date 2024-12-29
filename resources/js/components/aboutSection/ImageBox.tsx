import React from "react";
import { AboutMainImg } from "../../assets/images/about";
import SectionQuotes from "../SectionQuotes";

const ImageBox = ({ imgHeight = "h-[332px] lg:h-[704px] xl:h-[674px]" }) => {
	return (
		<section className='relative self-end '>
			<SectionQuotes className='absolute md:-translate-x-1/2 md:left-1/2 left-[-6%] md:top-0 -top-2 '>
				حقك ثمين ..... وتقييمنا ينصفك
			</SectionQuotes>
			<div className='relative w-[234px] lg:w-[380px] xl:w-[468px] '>
				<img
					className={`w-full ${imgHeight}`}
					src={AboutMainImg}
					alt='about-main-img'
					loading='lazy'
				/>
				<div className='bg-vision-img glass-effect'></div>
			</div>
		</section>
	);
};

export default ImageBox;
