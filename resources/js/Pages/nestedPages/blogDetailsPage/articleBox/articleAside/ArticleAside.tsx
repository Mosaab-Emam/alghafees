import React from "react";
import AdsBox from "./AdsBox";
import LatestTopics from "./latestTopics/LatestTopics";
import SearchInBlog from "../../../../blog/blogTopSection/SearchInBlog";

const ArticleAside = () => {
	return (
		<aside className='xl:w-[390px] lg:w-[360px] w-full flex flex-col items-start xl:gap-[70px] lg:gap-8 gap-8'>
			<SearchInBlog className='md:hidden flex xl:w-[390px] lg:w-[360px] w-full' />
			<AdsBox className='hidden md:flex' />
			<SearchInBlog className='hidden md:flex xl:w-[390px] lg:w-[360px] w-full' />
			<LatestTopics className='' />
			<AdsBox className='md:hidden flex ' />
		</aside>
	);
};

export default ArticleAside;
