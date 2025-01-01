import React from "react";

import BlogsBoxTitle from "./BlogsBoxTitle";
import BlogsFrame from "./BlogsFrame";
import BlogPagination from "./BlogPagination";

const BlogsBox = () => {
	return (
		<section className='mb-[80px]'>
			<BlogsBoxTitle />
			<BlogsFrame />
			<BlogPagination />
		</section>
	);
};

export default BlogsBox;
