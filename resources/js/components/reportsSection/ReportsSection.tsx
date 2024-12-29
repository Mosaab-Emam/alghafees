import React from "react";
import TextBox from "./TextBox";
import ReportsTabs from "./ReportsTabs";

import "./ReportsSection.css";

const ReportsSection = () => {
	return (
		<section className='section-box-shadow rounded-[10px] md:mt-32 mt-96 lg:mb-0 mb-16 pb-12'>
			<section className='container'>
				<TextBox />
				<ReportsTabs />
			</section>
		</section>
	);
};

export default ReportsSection;
