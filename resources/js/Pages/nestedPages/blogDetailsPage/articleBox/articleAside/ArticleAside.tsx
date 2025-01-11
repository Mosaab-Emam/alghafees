import { Post } from "@/types";
import SearchInBlog from "../../../../blog/blogTopSection/SearchInBlog";
import AdsBox from "./AdsBox";
import LatestTopics from "./latestTopics/LatestTopics";

export default function ArticleAside({
    latest_posts,
}: {
    latest_posts: Array<Post>;
}) {
    return (
        <aside className="xl:w-[390px] lg:w-[360px] w-full flex flex-col items-start xl:gap-[70px] lg:gap-8 gap-8">
            <SearchInBlog className="md:hidden flex xl:w-[390px] lg:w-[360px] w-full" />
            <AdsBox className="hidden md:flex" />
            <SearchInBlog className="hidden md:flex xl:w-[390px] lg:w-[360px] w-full" />
            <LatestTopics latest_posts={latest_posts} />
            <AdsBox className="md:hidden flex " />
        </aside>
    );
}
