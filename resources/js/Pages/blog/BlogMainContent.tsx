import { Post, Tag } from "@/types";
import BlogTopSection from "./blogTopSection/BlogTopSection";
import BlogsBox from "./blogsBox/BlogsBox";

export default function ServicesMainContent({
    posts,
    max_pages,
    tags,
}: {
    posts: Array<Post>;
    max_pages: number;
    tags: Array<Tag>;
}) {
    return (
        <section className="container md:mt-[211px] mt-[6rem]">
            <BlogTopSection tags={tags} />
            <BlogsBox posts={posts} max_pages={max_pages} />
        </section>
    );
}
