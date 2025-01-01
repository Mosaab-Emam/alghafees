import React from "react";
import PageHeader from "./pageHeader/PageHeader";
import PagesSeo from "./PagesSeo";

const PageTopSection = ({ title, description }) => {
	return (
		<>
			<PagesSeo title={title} description={description} />
			<PageHeader page_title={title} page_description={description} />
		</>
	);
};

export default PageTopSection;
