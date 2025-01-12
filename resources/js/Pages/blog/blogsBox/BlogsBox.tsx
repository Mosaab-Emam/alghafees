import { Post } from "@/types";
import BlogPagination from "./BlogPagination";
import BlogsBoxTitle from "./BlogsBoxTitle";
import BlogsFrame from "./BlogsFrame";

export default function BlogsBox({
    posts,
    max_pages,
}: {
    posts: Array<Post>;
    max_pages: number;
}) {
    return (
        <section className="mb-[80px]">
            <BlogsBoxTitle />
            <BlogsFrame posts={posts} />
            <BlogPagination max_pages={max_pages} />
        </section>
    );
}
