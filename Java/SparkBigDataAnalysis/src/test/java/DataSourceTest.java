import org.junit.Test;
import static org.junit.Assert.assertEquals;

import java.util.Arrays;
import java.util.List;

import de.due.ldsa.bd.DataProvider;

public class DataSourceTest {
	@Test
	public void testSetAndGetStringSourceData() {
		String data = "Hello World";
		
		DataProvider source1 = new DataProvider();	
		source1.setSourceData(data);
		
		DataProvider source2 = new DataProvider();	
		assertEquals(source2.getStringSourceData(), data);
	}
	
	@Test
	public void testSetAndGetListSourceData() {
		List<String> data = Arrays.asList("Hello World1", "Hello World2");
		
		DataProvider source1 = new DataProvider();	
		source1.setSourceData(data);
		
		DataProvider source2 = new DataProvider();	
		assertEquals(source2.getListSourceData(), data);
	}
}
