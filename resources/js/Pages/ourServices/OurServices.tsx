import React, { useEffect } from "react";
import { PageTopSection } from "../../components";
import { Outlet } from "react-router-dom";

const OurServices = () => {
	useEffect(() => {
		window.scrollTo(0, 0);
	}, []);

	return (
		<>
			<PageTopSection title={"خدماتنا"} description={"حلول عقارية"} />
			<Outlet />
		</>
	);
};

export default OurServices;
