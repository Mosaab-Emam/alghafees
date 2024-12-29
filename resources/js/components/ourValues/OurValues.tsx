import React from "react";

import { SvgLogoAbout } from "../../assets/images/about";
import ValuesBox from "./ValuesBox";
import OurVisionBox from "./OurVisionBox";
import AboutUsBuildingBgBox from "./AboutUsBuildingBgBox";
import "./OurValues.css";
import AboutBoxThree from "../../pages/aboutUs/AboutBoxThree";

const OurValues = () => {
	return (
		<section className='container relative '>
			<div className='xl:w-[1222px] lg:w-[1024px] w-full xl:h-[601px] lg:h-[630px] h-auto '>
				<div className='w-full xl:h-full h-[382px] absolute md:-top-24 top-[-134px] our-values-bg'></div>
				<section className='relative z-10 '>
					<AboutBoxThree />
					<section className='flex md:flex-row flex-col justify-center md:items-end items-center md:gap-[141.24px] gap-[90px] relative'>
						<span className='our-values-bg-span md:absolute md:top-[3rem] md:left-1/2 md:-translate-x-1/2'>
							<SvgLogoAbout />
						</span>

						<div className='md:flex md: relative -top-[3rem]'>
							<AboutUsBuildingBgBox />
							<OurVisionBox />
							<ValuesBox />
						</div>
					</section>
				</section>
			</div>
		</section>
	);
};

export default OurValues;
