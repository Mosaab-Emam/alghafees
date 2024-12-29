import React, { useEffect } from "react";
import { OurValues, PageTopSection, ReportsSection } from "../../components";

import AboutBoxOne from "./AboutBoxOne";
import AboutBoxTwo from "./AboutBoxTwo";

import "./AboutUs.css";

const AboutUs = () => {
	useEffect(() => {
		window.scrollTo(0, 0);
	}, []);
	return (
		<>
			<PageTopSection title={"من نحن"} description={"خبرة موثوقة"} />
			<>
				<AboutBoxOne />
				<AboutBoxTwo />

				<OurValues />
				<ReportsSection />
			</>
		</>
	);
};

export default AboutUs;
