import React from "react";

import MainMessage from "./MainMessage";

import DownloadApp from "./DownloadApp";
import SectionTitle from "../../SectionTitle";

import ContentBox from "./ContentBox";

const HeroTextBox = () => {
	return (
		<section className='text-right flex flex-col justify-center items-start gap-[30px] z-[1] '>
			<SectionTitle isHeroSection={true} />
			<MainMessage />
			<ContentBox className='hidden md:flex ' />
			<DownloadApp className='hidden md:flex ' />
		</section>
	);
};

export default HeroTextBox;
