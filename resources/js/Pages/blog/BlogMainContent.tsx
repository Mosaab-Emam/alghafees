import { Post } from "@/types";
import BlogTopSection from "./blogTopSection/BlogTopSection";
import BlogsBox from "./blogsBox/BlogsBox";

export default function ServicesMainContent({
    posts,
    max_pages,
}: {
    posts: Array<Post>;
    max_pages: number;
}) {
    return (
        <section className="container md:mt-[211px] mt-[6rem]">
            <BlogTopSection />
            <BlogsBox posts={posts} max_pages={max_pages} />
        </section>
    );
}
