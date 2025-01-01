import React from "react";
import BlogTopSection from "./blogTopSection/BlogTopSection";
import BlogsBox from "./blogsBox/BlogsBox";

const ServicesMainContent = () => {
	return (
		<section className='container md:mt-[211px] mt-[6rem]'>
			<BlogTopSection />
			<BlogsBox />
		</section>
	);
};

export default ServicesMainContent;
