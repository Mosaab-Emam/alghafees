import React, { useEffect } from "react";
import { PageTopSection } from "../../components";
import { Outlet } from "react-router-dom";

const Blog = () => {
	useEffect(() => {
		window.scrollTo(0, 0);
	}, []);

	return (
		<>
			<PageTopSection title={"المدونة"} description={"نصائح عقارية"} />
			<Outlet />
		</>
	);
};

export default Blog;
