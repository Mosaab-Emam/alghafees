import React from "react";
import { Helmet } from "react-helmet-async";

const PagesSeo = ({ title = "", description = "" }) => {
	return (
		<Helmet>
			<title>{title || ""} | شركة صالح الغفيض للتقييم العقاري</title>
			<meta name='description' content={description || ""} />
		</Helmet>
	);
};

export default PagesSeo;
