import React from "react";
import BoxOne from "./BoxOne";
import ServicesImages from "../../components/ourServices/ServicesImages";
import OurRealStateServices from "./ourRealStateServices/OurRealStateServices";

const ServicesMainContent = () => {
	return (
		<section className='container md:mt-[211px] mt-[6rem]'>
			<BoxOne />
			<ServicesImages />
			<OurRealStateServices />
		</section>
	);
};

export default ServicesMainContent;
