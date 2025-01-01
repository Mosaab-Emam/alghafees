import React, { useEffect } from "react";
import { PageTopSection } from "../../components";

import { Outlet } from "react-router-dom";

const Events = () => {
	useEffect(() => {
		window.scrollTo(0, 0);
	}, []);

	return (
		<>
			<PageTopSection title={"الفعاليات"} description={"أحدث الفعاليات"} />
			<Outlet />
		</>
	);
};

export default Events;
