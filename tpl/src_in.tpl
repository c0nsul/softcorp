<tr>
    <td>{SRC_N}</td>
    <td>{SRC_NAME}</td>
    <td>{SRC_URL}</td>
    <td><a onclick="return confirmDelete();" href="admin.php?route=del_source&id={SRC_ID}"><button type="button" class="btn btn-danger">Удалить</button></a></td>
    <td><a onclick="startParser({SRC_ID});" href="admin.php?route=parser&id={SRC_ID}"><button type="button" class="btn btn-primary">Старт</button></a><div id="src_{SRC_ID}"></div></td>
</tr>