import React from "react";
import SocialItemBoxFrame from "../followUsBox/SocialItemBoxFrame";

const FloatSocialIcons = () => {
	return (
		<section className=' absolute 2xl:left-0 md:-left-10 left-0 md:top-2 top-0 w-[36px] flex flex-col items-start gap-4 z-[1]'>
			<div className='w-[36px] flex flex-col items-center gap-4 self-stretch'>
				<SocialItemBoxFrame />
			</div>
			<div className='w-[36px] flex flex-col justify-center items-center gap-4 p-[10px] self-stretch bg-[rgba(243,249,250,0.20)] mt-20'>
				<p className='regular-b1 text-Gray-scale-01 transform -rotate-90 whitespace-nowrap tracking-wider'>
					.Saleh Al-Ghafis REV.Co
				</p>
			</div>
		</section>
	);
};

export default FloatSocialIcons;
